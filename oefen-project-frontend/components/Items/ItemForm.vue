<template>
  <form class="w-full max-w-sm mt-3" @submit.prevent="save">
    <div class="md:flex md:items-center mb-6">
      <div class="md:w-1/3">
        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="name">
          Name of product
        </label>
      </div>
      <div class="md:w-2/3">
        <input
            id="name"
            v-model="item.name"
            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
            placeholder="name" type="text">
      </div>
    </div>
    <div class="md:flex md:items-center mb-6">
      <div class="md:w-1/3">
        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="price">
          Price
        </label>
      </div>
      <div class="md:w-2/3">
        <input
            id="price"
            v-model="item.price"
            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
            placeholder="€00,00" step="0.01" type="number">
      </div>
    </div>
    <div class="md:flex md:items-center mb-6">
      <div class="md:w-1/3">
        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="stock">
          Stock
        </label>
      </div>
      <div class="md:w-2/3">
        <input
            id="stock"
            v-model="item.stock"
            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
            placeholder="Amount" type="number">
      </div>
    </div>
    <div class="md:flex md:items-center mb-6">
      <div class="md:w-1/3">
        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="Description">
          Description
        </label>
      </div>
      <div class="md:w-2/3">

        <textarea id="Description" v-model="item.summary"
                  class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 resize-none"
                  placeholder="Description" rows="6" type="text">
        </textarea>
      </div>
    </div>
    <div class="md:flex md:items-center">
      <div class="md:w-1/3"></div>
      <div class="md:w-2/3">
        <button
            class="inline-flex items-center mt-2 mb-2 px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25"
            type="submit">
          Add Item
        </button>
        <button
            class="inline-flex items-center mt-2 ms-4 mb-2 px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25"
            type="button">
          <nuxt-link to="../products">
            Return
          </nuxt-link>
        </button>
      </div>
    </div>
  </form>
</template>

<script lang="ts">

import axios from "axios";

export default {
  props: {
    id: {
      type: Number,
      default: null,
    }
  },
  data() {
    return {
      item: {
        name: '',
        price: '',
        summary: '',
        stock: '',
      }
    }
  },
  mounted() {
    this.getItemInformation()
  },
  methods: {
    getItemInformation() {
      if (!this.id) {
        return
      }
      axios.get(`http://localhost:8000/api/products/${this.id}`)
          .then(res => res.data)
          .then(item => {
            this.item = item
            if (item) {
              console.log(item)
            } else {
              console.log("Item not found please try again")
            }
          })
    },
    save() {
      this.$emit('save', this.item);
    },
  }
}


</script>