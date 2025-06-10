<template>
  <AppSidebarLayout>
    <div class="container mx-auto px-6 py-10 font-sans bg-gray-50 min-h-screen">
      <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-black text-gray-800 tracking-tight">📊 Lista de Ventas</h1>
        <Link
          :href="route('ventas.create')"
          class="bg-gradient-to-r from-pink-500 to-purple-600 text-white font-bold px-6 py-3 rounded-xl shadow-lg hover:from-pink-600 hover:to-purple-700 transition-all duration-300 ease-in-out"
          as="button"
        >
          ➕ Nueva Venta
        </Link>
      </div>

      <div
        class="bg-white shadow-2xl rounded-3xl ring-1 ring-gray-200 overflow-hidden"
      >
        <div class="overflow-x-auto">
          <table class="w-full min-w-max divide-y divide-gray-200 text-sm">
            <thead class="bg-gradient-to-r from-gray-100 to-gray-200">
              <tr>
                <th class="px-6 py-4 text-left font-bold text-gray-600 uppercase tracking-wider">ID</th>
                <th class="px-6 py-4 text-left font-bold text-gray-600 uppercase tracking-wider">Cliente</th>
                <th class="px-6 py-4 text-left font-bold text-gray-600 uppercase tracking-wider">Vendedor</th>
                <th class="px-6 py-4 text-left font-bold text-green-700 uppercase tracking-wider">Total</th>
                <th class="px-6 py-4 text-left font-bold text-gray-600 uppercase tracking-wider">Fecha</th>
                <th class="px-6 py-4 text-left font-bold text-gray-600 uppercase tracking-wider">Acciones</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
              <tr
                v-for="venta in ventas"
                :key="venta.id"
                class="hover:bg-purple-50 transition-all duration-150"
              >
                <td class="px-6 py-4 text-gray-800 font-medium">{{ venta.id }}</td>
                <td class="px-6 py-4 text-gray-800">{{ venta.cliente_nombre }}</td>
                <td class="px-6 py-4 text-gray-800">{{ venta.usuario?.nombre }}</td>
                <td class="px-6 py-4 text-green-600 font-bold">{{ venta.total }} Bs</td>
                <td class="px-6 py-4 text-gray-600">{{ venta.fecha_registro }}</td>
                <td class="px-6 py-4 flex gap-4 items-center">
                  <Link
                    :href="route('ventas.show', venta.id)"
                    class="text-indigo-600 hover:underline flex items-center gap-1"
                    title="Ver detalles"
                  >
                    <i class="fas fa-eye"></i> Ver
                  </Link>
                  <button
                    @click="confirmDelete(venta)"
                    class="text-red-600 hover:text-red-400 font-semibold flex items-center gap-1"
                    title="Eliminar venta"
                  >
                    <i class="fas fa-trash-alt"></i> Eliminar
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div v-if="!ventas.length" class="p-6 text-center text-gray-500">
          💤 No hay ventas registradas todavía.
        </div>
      </div>
    </div>
  </AppSidebarLayout>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import AppSidebarLayout from '@/layouts/app/AppSidebarLayout.vue';

const props = defineProps({
  ventas: {
    type: Array,
    required: true,
  },
});

const confirmDelete = (venta) => {
  if (confirm(`¿Estás seguro de eliminar la venta #${venta.id}?`)) {
    router.delete(route('ventas.destroy', venta.id));
  }
};
</script>
