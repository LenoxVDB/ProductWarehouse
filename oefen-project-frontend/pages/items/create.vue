<template>
  <ItemForm @save="save"/>
</template>

<script>

import ItemForm from "~/components/Items/ItemForm.vue";
import axios from "axios";
import {toast} from "vue3-toastify";
export default {
  components: {ItemForm},
  data() {
    return {
      item: {
        name: '',
        price: '',
        stock: '',
        summary: ''
      }
    }
  },
  methods: {
    async save(data) {
      this.item = {...data}
      const res = await axios.post('http://localhost:8000/api/products', this.item)
      await navigateTo('/products');
      toast.success("Product successfully added", {
        transition: "side",
        autoClose: 1500
      })
    }
  }
}
</script>