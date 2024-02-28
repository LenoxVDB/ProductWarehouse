<template>
  <div class="flex flex-col">
    <div class="max-h-[42.50rem] overflow-y-scroll">
      <h2 class="font-bold mb-3 text-lg text-center border border-b-2">Products in this warehouse</h2>
      <table class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
        <tr>
          <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-center">
            Product name
          </th>
          <th scope="col" class="px-6 py-3 text-center">
            Price
          </th>
          <th scope="col" class="px-6 py-3 text-center">
            Stock in Warehouse
          </th>
          <th scope="col" class="px-6 py-3 text-center">
            Description
          </th>
          <th scope="col" class="px-6 py-3 text-center">
            Update Stock
          </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="warehouse in WarehouseItem" class="border-b border-gray-200 dark:border-gray-700">
          <td
              class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800 text-center">
            {{ warehouse.name }}
          </td>
          <td class="px-6 py-4 text-center">
            €{{ warehouse.price }}
          </td>
          <td class="px-6 py-4 text-center">
            {{ warehouse.productWarehouse.stock }}
          </td>
          <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800 text-center">
            {{ warehouse.summary }}
          </td>
          <td>
            <button v-on:click="saveWarehouse(warehouse)"
                    class=" items-center ms-2 mt-2 mb-2 px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25">
              Update Stock
            </button>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
    <NuxtLink to="/">
      <button
          class=" inline-flex items-center ms-2 mt-2 mb-2 px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25">
        Return
      </button>
    </NuxtLink>
    <div class="">
      <update-warehouse-information :item="warehouse" v-if="toggle" @updated="handleUpdateStock"/>
    </div>
  </div>
</template>


<script>
import axios from "axios";
import Create from "~/pages/items/create.vue";
import ItemForm from "~/components/Items/ItemForm.vue";
import UpdateWarehouseInformation from "~/components/warehouses/updateWarehouseInformation.vue";
import {toast} from "vue3-toastify";
export default {
  components: {UpdateWarehouseInformation, ItemForm, Create},
  data() {
    return {
      WarehouseItem: [],
      id: null,
      item: {
        name: '',
        price: '',
        stock: '',
        summary: ''
      },
      toggle: false,
      warehouse: []
    }
  },
  mounted() {
    this.id = this.$route.params.warehouse;
    this.getWarehouseProducts();
  },
  methods: {
    getWarehouseProducts() {
      axios.get(`http://localhost:8000/api/warehouses/${this.id}/products`).then(res => {
        this.WarehouseItem = res.data.data;
      })
    },
    async save(data) {
      this.item = {...data}
      const res = await axios.post('http://localhost:8000/api/warehouse', this.item)
    },
    saveWarehouse(data) {
      this.toggle = !this.toggle
      this.warehouse = data
    },
    handleUpdateStock(updateData) {
      const {id, stock} = updateData
      this.WarehouseItem = this.WarehouseItem.map(warehouseItem => {
        if ('productWarehouse' in warehouseItem && warehouseItem.productWarehouse.product_id === id) {
          warehouseItem.productWarehouse.stock = stock
        }
        return warehouseItem;
      })
      this.toggle = false
    }
  }
}
</script>
