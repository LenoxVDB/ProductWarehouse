<template>
  <div class="flex flex-col">
    <div class="max-h-[40rem] max-w-[29.52rem] overflow-y-scroll">
      <table>
        <thead class="w-40">
        <th scope="col" class="border border-slate-300">Name</th>
        <th scope="col" class="border border-slate-300">Total items in Warehouse Stock</th>
        <th scope="col" class="border border-slate-300">View</th>
        </thead>
        <tbody>
        <tr v-for="warehouse in warehouses" :key="warehouse.id">
          <td class="border border-slate-300 p-4 text-center">{{ warehouse.name }}</td>
          <td class="border border-slate-300 p-4 text-center">{{ stockForWarehouse(warehouse) }}</td>
          <td class="border border-slate-300 p-4">
            <button>
              <NuxtLink :to="`/warehouses/${warehouse.id}`">
                <button
                    class="inline-flex items-center mt-2 mb-2 px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25"
                    type="submit">
                  View Warehouse
                </button>
              </NuxtLink>
            </button>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
  <button
      class="inline-flex items-center ms-2 mt-2 mb-2 px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25"
      type="button" @click="toggleComponents">
    Toggle Create Warehouse
  </button>
  <NuxtLink to="/products">
  <button
      class="inline-flex items-center ms-2 mt-2 mb-2 px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25"
      type="button">
    View all products
  </button>
  </NuxtLink>
  <div class="">
    <CreateWarehouse v-if="toggle"/>
  </div>


</template>

<script lang="ts">
import axios from "axios";
import CreateWarehouse from "~/components/warehouses/CreateWarehouse.vue";
export default {
  components: {CreateWarehouse},
  data() {
    return {
      warehouses: [],
      toggle: false
    }
  },
  mounted() {
    this.getWarehouses();
  },
  methods: {
    getWarehouses() {
      axios.get('http://localhost:8000/api/warehouses').then(res => {
        this.warehouses = res.data.data;
      })
    },
    stockForWarehouse(warehouse: object): string {
      return warehouse.products.reduce((totalStock, product) => {
        totalStock += product.pivot.stock
        return totalStock
      }, 0)
    },
    toggleComponents(): void {
      this.toggle = !this.toggle;
    }
  },
}

</script>
