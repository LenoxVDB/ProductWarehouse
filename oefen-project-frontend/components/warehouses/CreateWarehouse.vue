<template>
  <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" @submit.prevent="createWarehouse">
        <div>
          <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
          <div class="mt-2">
            <input v-model="item.name" id="name" name="name" type="text" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
          </div>
        </div>
        <div>
          <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create warehouse </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import axios from "axios";
  export default {
    data() {
      return {
        item: {
          name: '',
        }
      }
    },
    methods: {
      async createWarehouse() {
        try {
          const res = await axios.post('http://localhost:8000/api/warehouse', this.item);
          console.log(res.data);
        } catch (error) {
          console.error(error);
        }
      }
    }
  }
</script>
