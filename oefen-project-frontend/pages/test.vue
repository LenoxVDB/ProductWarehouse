<template>
  <div>
    <pre>{{ products }}</pre>
    <button @click="getData()">klik op mij</button>
  </div>


</template>

<script lang="ts">
import {useRepo} from "pinia-orm";
import Product from "~/models/Product";
import axios from "axios";
import Warehouse from "~/models/Warehouse";
import type {Repository} from "pinia-orm";

export default {
  methods: {
    async getData() {
      await axios.get(`http://127.0.0.1:8000/api/warehouses/3`).then(res => {
        this.warehouseRepo.save(res.data.data)
      })
    }
  },
  computed: {
    productRepo(): Repository<Product> {
      return useRepo(Product)
    },
    warehouseRepo(): Repository<Warehouse> {
      return useRepo(Warehouse)
    },
    products(): Product[] {
      return this.productRepo.query().with('warehouses')
          .get();
    },
  }
}

</script>
