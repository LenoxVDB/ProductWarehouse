<template>
  <div>
    <pre>{{ products}}</pre>
    <pre>{{ products}}</pre>
    <pre>{{ products}}</pre>
    <pre>{{ products}}</pre>
    <pre>{{ products}}</pre>
    <pre>{{ products}}</pre>
  </div>


</template>

<script lang="ts">
import axios from "axios";
import CreateWarehouse from "~/components/warehouses/CreateWarehouse.vue";
import {useRepo} from "pinia-orm";
import Product from "~/models/Product";

export default {
  mounted() {
    this.productRepo.save({
      id: 1,
      name: 'test',
      price: 10,
      summary: 'ik ben een test na aanpassing',
      created_at: '',
      updated_at: '',
      warehouses: [
        {
          id: 1,
          name: 'Rickert',
          created_at: '',
          updated_at: '',
          pivot: {
            product_id: 1,
            warehouse_id: 1,
            stock: 5,
            created_at: '',
            updated_at: '',
          }
        }
      ]
    })
  },
  computed: {
    productRepo() {
      return useRepo(Product)
    },
    products() {
      return this.productRepo.query()
          .get();
    },
  }
}

</script>
