<template>
    <div id="app" class="container">
      <h1 class="title">📊 Statistiques des Pandémies</h1>

      <!-- Filtres -->
      <div class="filters">
        <div class="filter-group">
          <label for="country">🌍 Sélectionner un pays :</label>
          <select id="country" v-model="selectedCountry" @change="fetchData">
            <option value="">Tous</option>
            <option v-for="country in countries" :key="country.id" :value="country.id">
              {{ country.name }}
            </option>
          </select>
        </div>

        <div class="filter-group">
          <label for="pandemic">🦠 Sélectionner une pandémie :</label>
          <select id="pandemic" v-model="selectedPandemic" @change="fetchData">
            <option value="">Toutes</option>
            <option v-for="pandemic in pandemics" :key="pandemic.id" :value="pandemic.id">
              {{ pandemic.name }}
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
import Highcharts from 'highcharts';
import { Chart } from 'highcharts-vue';
import axios from 'axios';

// Désactivation du module Accessibility pour éviter le warning
Highcharts.setOptions({
  accessibility: {
    enabled: false
  }
});

export default {
  name: 'GraphComponent',
  components: {
    highcharts: Chart,
  },
  data() {
    return {
      selectedCountry: "63",
      selectedPandemic: "1",
      startDate: "2020-03-02",
      endDate: "2020-03-10",
      countries: [],
      pandemics: [],
      chartOptions: {
        chart: {
          type: 'column',
          backgroundColor: '#f8f9fa',
        },
        title: {
          text: 'Statistiques des Pandémies',
          style: { color: '#333', fontSize: '20px' }
        },
        xAxis: {
          categories: [],
          labels: { style: { color: '#666' } }
        },
        yAxis: {
          title: {
            text: 'Nombre de cas',
            style: { color: '#666' }
          },
        },
        series: [],
      },
    };
  },
  mounted() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      const payload = {
        countryId: this.selectedCountry || "",
        typeId: this.selectedPandemic || "",
        startDate: this.startDate || "",
        endDate: this.endDate || ""
      };

      axios.post('/stats', payload, {
        headers: { 'Content-Type': 'application/json' }
      })
      .then(response => {
        const data = response.data;

        const categories = data.map(entry => entry.date);
        const cases = data.map(entry => entry.nouveaux_cas);
        const deaths = data.map(entry => entry.nouveaux_deces);
        const recoveries = data.map(entry => entry.nouveaux_gueris);

        this.chartOptions.xAxis.categories = categories;
        this.chartOptions.series = [
          { name: 'Nouveaux cas', data: cases, color: '#007bff' },
          { name: 'Nouveaux décès', data: deaths, color: '#dc3545' },
          { name: 'Nouveaux guéris', data: recoveries, color: '#28a745' }
        ];
      })
      .catch(error => {
        console.error("Erreur lors du chargement des données :", error);
      });
    },
  },
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
