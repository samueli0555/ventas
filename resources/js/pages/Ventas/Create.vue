<template>
  <AppLayout>
    <div class="min-h-screen bg-gradient-to-br from-purple-200 via-indigo-300 to-white py-12 px-4 sm:px-6 lg:px-8">
      <div class="max-w-3xl mx-auto bg-white border border-gray-300 p-10 rounded-2xl shadow-xl">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-8 text-center tracking-wide">
          Registrar Nueva Venta
        </h1>

        <form @submit.prevent="submitVenta">
          <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del Cliente</label>
            <input v-model="form.cliente_nombre" type="text"
              class="w-full rounded-lg px-4 py-2 bg-gray-100 border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-purple-500"
              required />
          </div>

          <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-3">Productos</h3>
            <div v-if="!productos.length" class="text-red-500 mb-4 italic">
              No hay productos disponibles para la venta.
            </div>

            <div v-for="(item, idx) in form.productos" :key="idx"
              class="mb-4 flex flex-col md:flex-row gap-3 items-center">
              <select v-model="item.id"
                class="rounded-lg px-2 py-2 w-full md:w-64 bg-white border border-gray-400 text-gray-900"
                required @change="updatePrecio(idx)">
                <option value="">Seleccione un producto</option>
                <option v-for="producto in productos" :key="producto.id" :value="producto.id">
                  {{ producto.nombre }} - {{ producto.precio }} Bs
                </option>
              </select>

              <input v-model.number="item.cantidad" type="number" min="1"
                class="w-full md:w-20 rounded-lg px-2 py-2 bg-gray-100 border border-gray-400 text-gray-900"
                required @input="updateSubtotal(idx)" />

              <input :value="item.precio_unitario + ' Bs'" type="text"
                class="w-full md:w-24 rounded-lg px-2 py-2 bg-gray-100 border border-gray-300 text-gray-700" readonly />

              <input :value="item.subtotal + ' Bs'" type="text"
                class="w-full md:w-24 rounded-lg px-2 py-2 bg-gray-100 border border-gray-300 text-gray-700" readonly />

              <button type="button" @click="removeProducto(idx)"
                class="text-red-600 hover:text-red-800 font-semibold">Eliminar</button>
            </div>

            <button type="button" @click="addProducto"
              class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg shadow">
              + Agregar Producto
            </button>
          </div>

          <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Total</label>
            <input :value="total + ' Bs'" type="text"
              class="w-full rounded-lg px-4 py-2 bg-gray-100 border border-gray-300 text-gray-900" readonly />
          </div>

          <div class="flex justify-end gap-4 mt-6">
            <Link :href="route('ventas.index')"
              class="bg-gray-400 hover:bg-gray-500 text-white px-5 py-2 rounded-lg shadow">
              Cancelar
            </Link>
            <button type="submit"
              class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow-lg">
              Registrar Venta
            </button>
          </div>
        </form>

        <div v-if="Object.keys(form.errors).length" class="text-red-600 mt-4 text-sm font-medium">
          <div v-for="(msg, key) in form.errors" :key="key">{{ msg }}</div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import { ref, computed, onMounted, watch } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';

const props = defineProps({
  productos: {
    type: Array,
    default: () => []
  },
  usuarios: {
    type: Array,
    default: () => []
  }
});

const form = useForm({
  cliente_nombre: '',
  productos: []
});

const addProducto = () => {
  form.productos.push({
    id: '',
    cantidad: 1,
    precio_unitario: 0,
    subtotal: 0
  });
};

const removeProducto = (idx) => {
  form.productos.splice(idx, 1);
};

const updatePrecio = (idx) => {
  const producto = props.productos.find(p => p.id === form.productos[idx].id);
  if (producto) {
    form.productos[idx].precio_unitario = producto.precio;
    updateSubtotal(idx);
  }
};

const updateSubtotal = (idx) => {
  form.productos[idx].subtotal = form.productos[idx].cantidad * form.productos[idx].precio_unitario;
};

const total = computed(() => {
  return form.productos.reduce((sum, item) => sum + item.subtotal, 0);
});

const submitVenta = () => {
  const productosValidos = form.productos.filter(item => item.id && item.cantidad > 0);
  if (productosValidos.length === 0) {
    alert('Debes agregar al menos un producto válido.');
    return;
  }
  const formData = {
    cliente_nombre: form.cliente_nombre,
    productos: productosValidos.map(item => ({
      id: item.id,
      cantidad: item.cantidad
    }))
  };
  router.post(route('ventas.store'), formData, {
    preserveScroll: true,
    onSuccess: () => {
      form.reset();
    },
    onError: () => {
      alert('Error al registrar la venta');
    }
  });
};

onMounted(() => {
  if (form.productos.length === 0) {
    addProducto();
  }
});

watch(
  () => form.productos.map(item => item.id),
  (newIds, oldIds) => {
    newIds.forEach((id, idx) => {
      if (id && (!oldIds || id !== oldIds[idx])) {
        updatePrecio(idx);
      }
    });
  }
);
</script>
