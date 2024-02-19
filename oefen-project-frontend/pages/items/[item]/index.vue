<template>
  <ItemForm v-if='id' :id='id' @save="save()"/>
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
    save() {
      console.log('(Update) Item: ', item)
      axios.put(`http://localhost:8000/api/products/${this.id}`, item)
          .then(res => res.data)
          .then(item => {
            console.log(item.data)
          })
    }
  }
}


</script>