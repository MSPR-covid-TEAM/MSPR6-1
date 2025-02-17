<template>
  <div id="app" class="container">
    <h1 class="title">📊 Statistiques des Pandémies</h1>

    <!-- Filtres -->
    <div class="filters">
      <div class="filter-group">
        <label for="country">🌍 Sélectionner un pays :</label>
        <select ref="countrySelect" id="country" v-model="selectedCountry" @change="fetchData">
          <option v-for="country in countries" :key="country.id_pays" :value="country.id_pays">
            {{ country.nom_pays }}
          </option>
        </select>
      </div>

      <div class="filter-group">
        <label for="pandemic">🦠 Sélectionner une pandémie :</label>
        <select ref="pandemicSelect" id="pandemic" v-model="selectedPandemic" @change="fetchData">
          <option v-for="pandemic in pandemies" :key="pandemic.id_pandemie" :value="pandemic.id_pandemie">
            {{ pandemic.nom_pandemie }}
          </option>
        </select>
      </div>

      <div class="filter-group">
        <label for="startDate">📅 Date de début :</label>
        <input type="date" id="startDate" v-model="startDate" @change="fetchData">
      </div>

      <div class="filter-group">
        <label for="endDate">📅 Date de fin :</label>
        <input type="date" id="endDate" v-model="endDate" @change="fetchData">
      </div>
    </div>

    <div class="chart-container">
      <highcharts :options="chartOptions"></highcharts>
    </div>
  </div>
</template>

<script>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import $ from 'jquery';
import 'select2/dist/css/select2.min.css';
import 'select2/dist/js/select2.full.min.js';
import Highcharts from 'highcharts';
import { Chart } from 'highcharts-vue';
import axios from 'axios';

export default {
  name: 'GraphComponent',
  components: {
    highcharts: Chart,
  },
  setup() {
    const countries = ref([]);
    const pandemies = ref([]);
    
    const selectedCountry = ref("63");
    const selectedPandemic = ref("1");
    const startDate = ref("2020-03-02");
    const endDate = ref("2020-03-10");
    
    const chartOptions = ref({
      chart: { type: 'column', backgroundColor: '#f8f9fa' },
      title: { text: 'Statistiques des Pandémies', style: { color: '#333', fontSize: '20px' } },
      xAxis: { categories: [], labels: { style: { color: '#666' } } },
      yAxis: { title: { text: 'Nombre de cas', style: { color: '#666' } } },
      series: [],
    });

    // Fonction pour récupérer les pays
    const fetchCategories = async () => {
      try {
        const response = await axios.get('/pays');
        countries.value = response.data;

        $(() => {
          $('#country').select2();
        });
      } catch (error) {
        console.error('Erreur lors du chargement des pays :', error);
      }
    };

    // Fonction pour récupérer les pandémies
    const fetchPandemie = async () => {
      try {
        const response = await axios.get('/pandemie');
        pandemies.value = response.data;

        $(() => {
          $('#pandemic').select2();
        });
      } catch (error) {
        console.error('Erreur lors du chargement des pandémies :', error);
      }
    };

    // Fonction pour récupérer les données de statistiques
    const fetchData = async () => {
      const payload = {
        countryId: selectedCountry.value || "",
        typeId: selectedPandemic.value || "",
        startDate: startDate.value || "",
        endDate: endDate.value || ""
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

      onMounted(() => {
      fetchCategories();
      fetchPandemie();
      fetchData();
    });

    return {
      countries,
      pandemies,
      selectedCountry,
      selectedPandemic,
      startDate,
      endDate,
      chartOptions,
      fetchData
    };
  }
};
</script>


<style>
body {
  font-family: 'Poppins', sans-serif;
  background-color: #f4f4f4;
  margin: 0;
  padding: 0;
}
.container {
  max-width: 900px;
  margin: auto;
  background: white;
  border-radius: 12px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  padding: 20px;
  margin-top: 20px;
}
.title {
  text-align: center;
  font-size: 24px;
  color: #333;
  margin-bottom: 20px;
}
.filters {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  gap: 10px;
  margin-bottom: 20px;
}
.filter-group {
  flex: 1;
  min-width: 200px;
}
label {
  font-weight: bold;
  display: block;
  margin-bottom: 5px;
  color: #555;
}
select, input {
  width: 100%;
  padding: 8px;
  border-radius: 6px;
  border: 1px solid #ddd;
  background: #fff;
}
.chart-container {
  background: white;
  border-radius: 12px;
  padding: 20px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
</style>
