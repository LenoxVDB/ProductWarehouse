<template>
  <div>
    <pre>{{ products }}</pre>
    <button @click="getData()">klik op mij</button>
  </div>


</template>

<script>
import {useRepo} from "pinia-orm";
import Product from "~/models/Product";
import axios from "axios";
import Warehouse from "~/models/Warehouse";
export default {
  methods: {
    getData() {
      axios.get(`http://127.0.0.1:8000/api/warehouses/3`).then(res => {
        this.warehouseRepo.save(res.data.data)
      })
    }
  },
  computed: {
    productRepo() {
      return useRepo(Product)
    },
    warehouseRepo() {
      return useRepo(Warehouse)
    },
    products() {
      return this.productRepo.query().with('warehouses')
          .get();
    },
  }
}

</script>
