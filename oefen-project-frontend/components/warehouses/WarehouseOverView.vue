<template>
  <div class="flex flex-col">
    <div class="max-h-[42.50rem] overflow-y-scroll">
      <h2 class="font-bold mb-3 text-lg text-center">Products in this warehouse</h2>
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
          <th>
            Update
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
            {{ warehouse.product_warehouse.stock }}
          </td>
          <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800 text-center">
            {{ warehouse.summary }}
          </td>
          <td>
            <button @click="updateProduct(warehouse.product_warehouse)" class=" items-center ms-2 mt-2 mb-2 px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25">
              Update
            </button>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
    <NuxtLink to="/">
      <button class=" inline-flex items-center ms-2 mt-2 mb-2 px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25">
        Return
      </button>
    </NuxtLink>
    <div class="">
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Create from "~/pages/items/create.vue";
import ItemForm from "~/components/Items/ItemForm.vue";

export default {
  components: {ItemForm, Create},
  data() {
    return {
      WarehouseItem: [],
      id: null,
      item: {
        name: '',
        price: '',
        stock: '',
        summary: ''
      }
    }
  },
  mounted() {
    this.id = this.$route.params.warehouse;
    this.getWarehouseProducts();
  },
  methods: {
    getWarehouseProducts() {
      axios.get(`http://localhost:8000/api/warehouse/${this.id}`).then(res => {
        this.WarehouseItem = res.data.products;
        console.log(res.data)
      })
    },
    async save(data) {
      this.item = {...data}
      const res = await axios.post('http://localhost:8000/api/warehouse', this.item)
      alert(`Product successfully added:
       name: ${res.data.name}
       price: ${res.data.price}
       stock: ${res.data.stock}
       Description: ${res.data.summary}`
      );
    },
    updateProduct(data) {
      console.log(data)
    }
  }
}
</script>
