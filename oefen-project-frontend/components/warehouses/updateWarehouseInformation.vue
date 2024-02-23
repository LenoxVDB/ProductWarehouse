<template>
  <div class="w-[50%] h-[50%] mt-5">
    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="stock">
          Stock
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="stock" type="number" min="1" v-model="updateData.stock" placeholder="Stock" required>
      </div>
      <div class="flex items-center justify-between">
        <button v-on:click="updateProduct()"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="button">
          Update
        </button>
      </div>
    </form>
  </div>
</template>
<script>
import axios from "axios";
import {toast} from "vue3-toastify";
export default {

  data() {
    return {
      updateData: {
        stock: '',
      }
    }
  },
  props: {
    item: {}
  },
  methods: {
    async updateProduct() {
      try {
        this.toggle = !this.toggle
        const res = await axios.put(`http://localhost:8000/api/products/${this.item.productWarehouse.product_id}/warehouses/${this.item.productWarehouse.warehouse_id}`, this.updateData)
        toast.success("Warehouse successfully updated", {
          transition: "side",
          autoClose: 3000
        })
        setTimeout(() => {
          location.reload();
        }, 3500)
      } catch (error) {
        toast.error("Oops something went wrong!", {
          transition: "side"
        })
        console.log(error)
      }
    },
  }

}

</script>
