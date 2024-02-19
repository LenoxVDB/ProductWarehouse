<template>
  <div>
    <table>
      <thead class="w-40">
      <th class="border border-slate-300">name</th>
      <th class="border border-slate-300 p-2">price per item</th>
      <th class="border border-slate-300">Description</th>
      <th class="border border-slate-300">Delete</th>
      <th class="border border-slate-300">Update</th>
      </thead>
      <tbody>
      <tr v-for="product in products" :key="product.id">
        <td class="border border-slate-300 p-4">{{ product.name }}</td>
        <td class="border border-slate-300 text-center p-4">€{{ product.price }}</td>
        <td class="border border-slate-300 p-4">{{ product.summary }}</td>
        <td class="px-6 py-4 text-sm leading-5 text-center text-gray-900 whitespace-no-wrap border border-slate-300">
          <button
              class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25"
              @click="deleteProduct(product.id)">
            Delete
          </button>
        </td>
        <td class="px-6 py-4 text-sm leading-5 text-center text-gray-900 whitespace-no-wrap border border-slate-300">
          <NuxtLink :to="`Items/${product.id}`">
            <button
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25">
              Update
            </button>
          </NuxtLink>
        </td>
      </tr>
      </tbody>
    </table>
    <div
        class="inline-flex items-center mt-3 mb-2 ms-4 px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25">
      <button>
        <NuxtLink to="items/create">
          Add item
        </NuxtLink>
      </button>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      products: [],
    }
  },
  mounted() {
    this.getProducts();
  },
  methods: {
    getProducts() {
      axios.get('http://localhost:8000/api/products').then(res => {
        this.products = res.data;
      });
    },

    deleteProduct(id) {
      axios.delete(`http://localhost:8000/api/products/${id}`)
          .then(response => {
            this.products = this.products.filter(product => product.id !== id);
            console.log('Resource deleted successfully:', response.data);
          })
          .catch(error => {
            console.error('Error deleting resource:', error);
          });
    },
  }
}
</script>