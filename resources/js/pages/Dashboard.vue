<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import BarChart from '@/components/BarChart.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

defineProps(['productosVendidos', 'clientes', 'ventasPorMesLabels', 'ventasPorMesData', 'ventasPorDiaLabels', 'ventasPorDiaData'])
</script>
<template>
  <Head title="Dashboard" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-6 p-6 bg-gradient-to-br from-indigo-900 via-purple-900 to-blue-800 text-white rounded-xl shadow-xl">
      <!-- Cards -->
       
      <div class="grid auto-rows-min gap-6 md:grid-cols-3">
        <!-- Productos Vendidos -->
     <div
  class="relative aspect-video overflow-hidden rounded-xl shadow-lg hover:scale-105 transition-transform"
  style="
    background: linear-gradient(135deg, #1e40af, #6366f1, #3b82f6);
    border: 2px solid #facc15;
    box-shadow: inset 0 0 15px rgba(255, 255, 255, 0.1),
                0 8px 16px rgba(59, 130, 246, 0.4);
  "
>

          <PlaceholderPattern />
          <div class="p-4">
            <h3 class="text-xl font-semibold text-yellow-300">PRODUCTOS VENDIDOS</h3>
            <p class="text-white text-lg mt-2">Cantidad: {{ productosVendidos }}</p>
          </div>
        </div>

        <!-- Clientes -->
        <div
  class="relative aspect-video overflow-hidden rounded-xl shadow-lg hover:scale-105 transition-transform"
  style="
    background: linear-gradient(135deg, #9333ea, #a855f7, #d946ef);
    border: 2px solid #e879f9;
    box-shadow: inset 0 0 15px rgba(255, 255, 255, 0.1),
                0 8px 16px rgba(168, 85, 247, 0.4);
  "
>

          <PlaceholderPattern />
          <div class="p-4">
            <h3 class="text-xl font-semibold text-yellow-300">CLIENTES</h3>
            <p class="text-white text-lg mt-2">Cantidad: {{ clientes }}</p>
          </div>
        </div>

        <!-- Otro -->
     <div
  class="relative aspect-video overflow-hidden rounded-xl shadow-lg hover:scale-105 transition-transform"
  style="
    background: linear-gradient(135deg, #15803d, #22c55e, #4ade80);
    border: 2px solid #bbf7d0;
    box-shadow: inset 0 0 15px rgba(255, 255, 255, 0.1),
                0 8px 16px rgba(34, 197, 94, 0.4);
  "
>

          <PlaceholderPattern />
          <div class="p-4">
            <h3 class="text-xl font-semibold text-yellow-300">OTRO</h3>
            <p class="text-white text-lg mt-2">Contenido adicional</p>
          </div>
        </div>
      </div>    

     <!-- Contenedor flex para dos gráficos -->
<div
  class="mt-8 flex gap-6 justify-center max-w-full mx-auto"
  style="max-width: 100%;"
>
  <!-- Gráfico Ventas por Mes -->
  <div
    class="rounded-xl p-6 shadow-lg text-gray-100 flex-grow"
    style="
      background: linear-gradient(135deg, #4f46e5, #7c3aed, #3b82f6);
      box-shadow: inset 0 0 20px rgba(255, 255, 255, 0.2),
                  0 10px 15px rgba(124, 58, 237, 0.4);
      border: 2px solid #facc15;
      width: 48%;
      min-width: 450px;
    "
  >
    <h3 class="mb-4 text-lg font-bold text-yellow-300">Ventas por Mes</h3>
    <BarChart
      :labels="ventasPorMesLabels"
      :values="ventasPorMesData"
      label="Ventas"
    />
  </div>

  <!-- Gráfico Ventas por Semana -->
  <div
    class="rounded-xl p-6 shadow-lg text-gray-100 flex-grow"
    style="
      background: linear-gradient(135deg, #16a34a, #22c55e, #4ade80);
      box-shadow: inset 0 0 20px rgba(255, 255, 255, 0.2),
                  0 10px 15px rgba(34, 197, 94, 0.4);
      border: 2px solid #84cc16;
      width: 48%;
      min-width: 450px;
    "
  >
    <h3 class="mb-4 text-lg font-bold text-green-300">Ventas por Semana</h3>
    <BarChart
      :labels="ventasPorDiaLabels"
      :values="ventasPorDiaData"
      label="Ventas"
    />
  </div>
</div>

    </div>
  </AppLayout>
</template>
