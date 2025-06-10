<template>
  <AppSidebarLayout>
    <div class="container mx-auto px-6 py-10 bg-gradient-to-br from-indigo-100 via-purple-100 to-teal-100 rounded-2xl shadow-xl border border-indigo-200">
      
      <!-- Encabezado -->
      <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-extrabold text-indigo-700 tracking-tight">📊 Reportes de Ventas</h1>
        <div class="flex gap-4">
          <Link
            :href="route('ventas.create')"
            class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white font-bold px-5 py-2 rounded-lg shadow-md hover:scale-105 transition-transform"
            as="button"
          >
            ➕ Nuevo Reporte
          </Link>
          <a
             href="/pdf"
            class="cursor-pointer bg-gradient-to-r from-green-400 to-emerald-500 text-white font-bold px-5 py-2 rounded-lg shadow-md hover:scale-105 transition-transform"
          >
            📄 Descargar PDF
          </a>         
        </div>
      </div>

      <!-- Filtros por fechas -->
      <div class="flex gap-6 py-8 items-end">
        <div class="bg-white rounded-xl shadow-md p-4 border border-indigo-200 w-60 transition-transform hover:scale-105">
          <label for="fechaInicio" class="block text-sm font-semibold text-indigo-700 mb-1">
            📅 Desde
          </label>
          <input
            type="date"
            v-model="fechaInicio"
            id="fechaInicio"
            class="w-full border border-indigo-300 rounded-md px-3 py-2 text-indigo-800 focus:ring-2 focus:ring-indigo-300 focus:outline-none transition duration-300"
          />
        </div>
        <div class="bg-white rounded-xl shadow-md p-4 border border-purple-200 w-60 transition-transform hover:scale-105">
          <label for="fechaFin" class="block text-sm font-semibold text-purple-700 mb-1">
            📆 Hasta
          </label>
          <input
            type="date"
            v-model="fechaFin"
            id="fechaFin"
            class="w-full border border-purple-300 rounded-md px-3 py-2 text-purple-800 focus:ring-2 focus:ring-purple-300 focus:outline-none transition duration-300"
          />
        </div>
      </div>

      <!-- Tabla de ventas -->
      <div v-if="ventasFiltradas.length" class="overflow-auto rounded-lg shadow-lg">
        <table class="min-w-full bg-white rounded-lg overflow-hidden">
          <thead class="bg-indigo-200">
            <tr>
              <th class="px-6 py-4 text-left text-sm font-bold text-indigo-900 uppercase">N°</th>
              <th class="px-6 py-4 text-left text-sm font-bold text-indigo-900 uppercase">Cliente</th>
              <th class="px-6 py-4 text-left text-sm font-bold text-indigo-900 uppercase">Total</th>
              <th class="px-6 py-4 text-left text-sm font-bold text-indigo-900 uppercase">Fecha</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="(venta, index) in ventasFiltradas"
              :key="venta.id"
              class="hover:bg-purple-100 transition"
            >
              <td class="px-6 py-4 text-gray-800">{{ index + 1 }}</td>
              <td class="px-6 py-4 text-gray-800">{{ venta.cliente_nombre }}</td>
              <td class="px-6 py-4 text-gray-800">{{ venta.total }}</td>
              <td class="px-6 py-4 text-gray-800">{{ venta.fecha_registro }}</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Sin datos -->
      <div v-else class="mt-10 text-center">
        <p class="text-purple-600 text-lg italic">😔 No hay ventas disponibles en este momento.</p>
      </div>
    </div>
  </AppSidebarLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import AppSidebarLayout from '@/layouts/app/AppSidebarLayout.vue';
import { computed, ref } from 'vue';

const props = defineProps({
  ventas: {
    type: Array,
    required: true
  }
});

const fechaInicio = ref('');
const fechaFin = ref('');

const ventasFiltradas = computed(() => {
  return props.ventas.filter(venta => {
    const fecha = venta.fecha_registro.substring(0, 10); // yyyy-mm-dd
    const desde = fechaInicio.value || '0000-00-00';
    const hasta = fechaFin.value || '9999-12-31';
    return fecha >= desde && fecha <= hasta;
  });
});
</script>
