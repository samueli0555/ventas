<template>
  <Bar :data="chartData" :options="chartOptions" />
</template>

<script setup>
import { ref, watch, computed } from 'vue'
import { Bar } from 'vue-chartjs'
import { Chart, BarElement, CategoryScale, LinearScale, Tooltip, Legend } from 'chart.js'

Chart.register(BarElement, CategoryScale, LinearScale, Tooltip, Legend)

const props = defineProps({
  labels: Array,
  values: Array,
  label: String
})

// Usamos un computed para que los datos cambien según las props
const chartData = computed(() => ({
  labels: props.labels,
  datasets: [
    {
      label: props.label,
      backgroundColor: '#3b82f6',
      data: props.values,
    }
  ]
}))

const chartOptions = {
  responsive: true,
  plugins: {
    legend: { display: false }
  }
}
</script>
