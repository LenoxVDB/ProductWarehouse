<template>
  <ItemForm @save="save"/>
</template>

<script>

import ItemForm from "~/components/Items/ItemForm.vue";
import axios from "axios";

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
      alert(`Product successfully added:
       name: ${res.data.name}
       price: ${res.data.price}
       stock: ${res.data.stock}
       Description: ${res.data.summary}`
      );
      navigateTo('/');
    }
  }
}


</script>