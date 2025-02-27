<template>
    <div id="app" class="container">
        <h1 class="title">Statistiques des Pandémies</h1>

        <!-- Filtres -->
        <div class="filters">
            <div class="filter-group">
                <label for="country">Sélectionner un pays :</label>
                <select ref="countrySelect" id="country" v-model="selectedCountry">
                    <option v-for="country in countries" :key="country.id_pays" :value="country.id_pays">
                        {{ country.nom_pays }}
                    </option>
                </select>
            </div>

            <div class="filter-group">
                <label for="pandemic">Sélectionner une pandémie :</label>
                <select ref="pandemicSelect" id="pandemic" v-model="selectedPandemic">
                    <option v-for="pandemic in pandemies" :key="pandemic.id_pandemie" :value="pandemic.id_pandemie">
                        {{ pandemic.nom_pandemie }}
                    </option>
                </select>
            </div>

            <div class="filter-group">
                <label for="startDate">Date de début :</label>
                <input type="date" id="startDate" v-model="startDate">
            </div>

            <div class="filter-group">
                <label for="endDate">Date de fin :</label>
                <input type="date" id="endDate" v-model="endDate">
            </div>
        </div>

        <!-- ✅ Bouton OK bien positionné en dessous des filtres -->
        <div class="button-container">
            <button class="ok-button" @click="handleOkClick">OK</button>
        </div>

        <!-- 📊 Graphique -->
        <div class="chart-container">
            <highcharts :options="chartOptions"></highcharts>
        </div>
    </div>
</template>


<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Highcharts from 'highcharts';
import { Chart } from 'highcharts-vue';

export default {
    name: 'GraphComponent',
    components: {
        highcharts: Chart,
    },
    setup() {
        // 📌 Listes des pays et pandémies
        const countries = ref([]);
        const pandemies = ref([]);

        // 🔴 Valeurs utilisées pour la requête API (mises à jour après clic sur "OK")
        const selectedCountry = ref("63");
        const selectedPandemic = ref("1");
        const startDate = ref("2020-03-02");
        const endDate = ref("2020-03-10");

        // 🟠 Valeurs temporaires modifiables sans effet immédiat
        const tempSelectedCountry = ref(selectedCountry.value);
        const tempSelectedPandemic = ref(selectedPandemic.value);
        const tempStartDate = ref(startDate.value);
        const tempEndDate = ref(endDate.value);

        // 📊 Configuration du graphique
        const chartOptions = ref({
            chart: { type: 'column', backgroundColor: '#f8f9fa' },
            title: { text: 'Statistiques des Pandémies', style: { color: '#333', fontSize: '20px' } },
            xAxis: { categories: [], labels: { style: { color: '#666' } } },
            yAxis: { title: { text: 'Nombre de cas', style: { color: '#666' } } },
            series: [],
        });

        /**
         * 🔄 Récupère la liste des pays
         */
        const fetchCountries = async () => {
            try {
                const response = await axios.get('/pays');
                countries.value = response.data;
            } catch (error) {
                console.error('Erreur lors du chargement des pays :', error);
            }
        };

        /**
         * 🦠 Récupère la liste des pandémies
         */
        const fetchPandemics = async () => {
            try {
                const response = await axios.get('/pandemie');
                pandemies.value = response.data;
            } catch (error) {
                console.error('Erreur lors du chargement des pandémies :', error);
            }
        };

        /**
         * 📊 Récupère les statistiques en fonction des valeurs sélectionnées
         */
        const fetchData = async () => {
            const payload = {
                countryId: selectedCountry.value,
                typeId: selectedPandemic.value,
                startDate: startDate.value,
                endDate: endDate.value,
            };

            try {
                const response = await axios.post('/stats', payload, {
                    headers: { 'Content-Type': 'application/json' }
                });

                const data = response.data;
                const categories = data.map(entry => entry.date);
                const cases = data.map(entry => entry.nouveaux_cas);
                const deaths = data.map(entry => entry.nouveaux_deces);
                const recoveries = data.map(entry => entry.nouveaux_gueris);

                chartOptions.value.xAxis.categories = categories;
                chartOptions.value.series = [
                    { name: 'Nouveaux cas', data: cases, color: '#007bff' },
                    { name: 'Nouveaux décès', data: deaths, color: '#dc3545' },
                    { name: 'Nouveaux guéris', data: recoveries, color: '#28a745' }
                ];
            } catch (error) {
                console.error("Erreur lors du chargement des données :", error);
            }
        };

        /**
         * ✅ Applique les valeurs temporaires et met à jour les données
         */
        const handleOkClick = async () => {
            selectedCountry.value = tempSelectedCountry.value;
            selectedPandemic.value = tempSelectedPandemic.value;
            startDate.value = tempStartDate.value;
            endDate.value = tempEndDate.value;
            fetchData();
        };

        // 🛠️ Charge les pays et pandémies au démarrage
        onMounted(() => {
            fetchCountries();
            fetchPandemics();
        });

        return {
            countries,
            pandemies,
            tempSelectedCountry,
            tempSelectedPandemic,
            tempStartDate,
            tempEndDate,
            selectedCountry,
            selectedPandemic,
            startDate,
            endDate,
            chartOptions,
            handleOkClick,
        };
    }
};
</script>

<style>
/* 🌍 Style général */
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    color: #333;
}

/* 📦 Conteneur principal en pleine largeur */
.container {
    width: 100vw; /* 100% de la largeur de l'écran */
    max-width: 100%;
    padding: 20px;
    box-sizing: border-box;
}

/* 🏷️ Titre */
.title {
    text-align: center;
    font-size: 26px;
    font-weight: bold;
    color: #2c3e50;
    margin-bottom: 20px;
}

/* 🎛️ Filtres */
.filters {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    justify-content: center;
    margin-bottom: 20px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 10px;
    width: 100%;
}

/* 🔹 Groupes de filtres responsifs */
.filter-group {
    display: flex;
    flex-direction: column;
    flex: 1; /* Permet d'ajuster la largeur dynamiquement */
    min-width: 200px;
    max-width: 300px; /* Évite que les inputs ne soient trop larges */
}

/* 🏷️ Labels */
label {
    font-weight: 600;
    margin-bottom: 6px;
    color: #555;
}

/* 🏗️ Inputs et Selects */
select, input {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 14px;
    background: #fff;
}

/* ✅ Bouton OK en dessous des filtres */
.button-container {
    width: 100%;
    display: flex;
    justify-content: center;
    margin-top: 20px; /* Ajoute un espacement avec les filtres */
}

.ok-button {
    padding: 12px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s;
    font-size: 16px;
    width: 100%;
    max-width: 250px; /* Taille raisonnable du bouton */
    text-align: center;
}

.ok-button:hover {
    background-color: #0056b3;
}


/* 📊 Graphique en pleine largeur */
.chart-container {
    width: 100%;
    max-width: 100%;
    padding: 20px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: 0.3s;
    margin-top: 20px;
    margin-right: 20px;
}

/* 📱 Adaptation mobile */
@media screen and (max-width: 768px) {
    .filters {
        flex-direction: column;
        align-items: center;
    }

    .filter-group {
        width: 100%;
        max-width: 300px;
    }

    .ok-button {
        max-width: 100%;
    }
}

</style>
