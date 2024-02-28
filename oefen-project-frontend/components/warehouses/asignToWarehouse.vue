<template>
  <div class="flex flex-col">
    <div class="max-h-[42.50rem] overflow-y-scroll">
      <h2 class="font-bold mb-3 text-lg text-center border border-b-2">Products</h2>
      <table class="table table-striped">
        <thead>
        <tr>
          <th scope="col" class="px-6 py-3 text-center">Name</th>
          <th scope="col" class="px-6 py-3 text-center">Price</th>
          <th scope="col" class="px-6 py-3 text-center">Description</th>
          <th scope="col" class="px-6 py-3 text-center">Add to warehouse</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="product in products">
          <td class="text-center bg-gray-200 border border-slate-300">{{ product.name }}</td>
          <td class="text-center border border-slate-300">{{ product.price }}</td>
          <td class="text-center bg-gray-200 border border-slate-300">{{ product.summary }}</td>
          <td class="flex justify-center items-center mt-5">
            <button @click="addToWarehouse(product.id, product.warehouses[0].productWarehouse.stock)">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                   stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
              </svg>
            </button>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import {toast} from "vue3-toastify";


export default {
  props: {
    warehouseId: {
      type: Number
    }
  },
  data() {
    return {
      products: []
    }
  },
  mounted() {
    this.getProducts();
  },
  methods: {
    getProducts() {
      axios.get(`http://localhost:8000/api/products`).then(res => {
        this.products = res.data.data.filter(product => {
          if ('warehouses' in product) {
            return product.warehouses.every(warehouse => {
              return warehouse.productWarehouse.warehouse_id !== this.warehouseId
            })
          }
          return true
        })
      });
    },
    addToWarehouse(productId, product) {
      axios.post(`http://localhost:8000/api/products/${productId}/warehouses/${this.warehouseId}`, {"stock": product}).then(res => {
        console.log(res);
      })
      toast.success("Product successfully added")
    }
  }
}
</script>
