<template>
  <ItemForm v-if='id' :id='id' @save="save"/>
</template>

<script>
import ItemForm from "~/components/Items/ItemForm.vue";
import axios from "axios";

export default {
  components: {ItemForm},
  data() {
    return {
      id: null,
    }
  },
  mounted() {
    this.id = this.$route.params.item
  },
  methods: {
    save(data) {
      console.log('(Update) Item: ', data)
      axios.put(`http://localhost:8000/api/products/${this.id}`, data)
          .then(res => {
            console.log(res.data)
          })

    }
  }
}



</script>