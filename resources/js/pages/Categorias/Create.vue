<template>
  <div class="min-h-screen bg-gradient-to-br from-blue-100 via-blue-300 to-indigo-500 py-12 px-4">
    <div class="max-w-xl mx-auto">
      <!-- Encabezado -->
      <div class="text-center mb-10">
        <h1 class="text-4xl font-extrabold text-white tracking-tight">Nueva Categoría</h1>
        <p class="mt-2 text-gray-200 text-sm">Registra una categoría para organizar mejor tus elementos.</p>
      </div>

      <!-- Formulario -->
      <form
        @submit.prevent="submit"
        class="bg-white bg-opacity-80 border border-gray-200 shadow-xl rounded-3xl p-10 space-y-6 backdrop-blur-sm"
      >
        <!-- Nombre -->
        <div>
          <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre de la Categoría</label>
          <input
            v-model="form.nombre"
            type="text"
            id="nombre"
            required
            placeholder="Ej. Peces Tropicales"
            class="mt-2 w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none"
          />
        </div>

        <!-- Descripción -->
        <div>
          <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
          <textarea
            v-model="form.descripcion"
            id="descripcion"
            rows="4"
            placeholder="Agrega una breve descripción de esta categoría"
            class="mt-2 w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none resize-none"
          ></textarea>
        </div>

        <!-- Botones -->
        <div class="flex justify-end gap-4 pt-4">
          <Link
            :href="route('categorias.index')"
            class="inline-block rounded-xl border border-gray-300 bg-white px-6 py-2.5 text-sm font-medium text-gray-600 hover:bg-gray-100 transition"
          >
            Cancelar
          </Link>
          <button
            type="submit"
            class="inline-block rounded-xl bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white hover:bg-blue-700 transition disabled:opacity-50"
            :disabled="form.processing"
          >
            Guardar
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'

const form = useForm({
  nombre: '',
  descripcion: ''
})

const submit = () => {
  form.post(route('categorias.store'))
}
</script>

<script>
export default {
  layout: AppLayout
}
</script>
