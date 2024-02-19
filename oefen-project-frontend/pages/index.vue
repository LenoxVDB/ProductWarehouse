<template>
  <table>
    <thead class="w-40">
    <th class="border border-slate-300">Name</th>
    <th class="border border-slate-300">Total Warehouse Stock</th>
    </thead>
    <tbody>
    <tr v-for="warehouse in warehouses" :key="warehouse.id">
      <td class="border border-slate-300 p-4">{{ warehouse.name }}</td>
      <td class="border border-slate-300 p-4">{{ stockForWarehouse(warehouse) }}</td>
    </tr>
    </tbody>
  </table>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      warehouses: [],
    }
  },
  mounted() {
    this.getWarehouses();
  },
  methods: {
    getWarehouses() {
      axios.get('http://localhost:8000/api/warehouse').then(res => {
        this.warehouses = res.data;
      })
    },
    stockForWarehouse(warehouse) {
      return warehouse.products.reduce((totalStock, product) => {
        totalStock += product.product_warehouse.stock

        return totalStock
      }, 0)
    }
  }
}

</script>
