<template>
  <div class="flex flex-col">
    <div class="max-h-[42.50rem] overflow-y-scroll">
      <h2 class="font-bold mb-3 text-lg text-center border border-b-2">Products in this warehouse</h2>
      <table class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
        <tr>
          <th scope="col" class="px-6 py-3 text-center">
            Product name
          </th>
          <th scope="col" class="px-6 py-3 text-center">
            Price
          </th>
          <th scope="col" class="px-6 py-3 text-center">
            Stock in Warehouse
          </th>
          <th scope="col" class="px-6 py-3 text-center">
            Description
          </th>
          <th scope="col" class="px-6 py-3 text-center">
            Update Stock
          </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="product in products" class="border-b border-gray-200 dark:border-gray-700">
          <td
              class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800 text-center">
            {{ product.name }}
          </td>
          <td class="px-6 py-4 text-center">
            €{{ product.price }}
          </td>
          <td class="px-6 py-4 text-center">
            {{ product.warehouses[0].pivot.stock }}
          </td>
          <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800 text-center">
            {{ product.summary }}
          </td>
          <td>
            <button v-on:click="saveWarehouse(product)"
                    class=" items-center ms-2 mt-2 mb-2 px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25">
              Update Stock
            </button>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
    <NuxtLink to="/">
      <button
          class=" inline-flex items-center ms-2 mt-2 mb-2 px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25">
        Return
      </button>
    </NuxtLink>
    <div class="">
      <update-warehouse-information :productId="product.id" :warehouseId="warehouseId" v-if="toggle" @updated="handleUpdateStock"/>
    </div>
  </div>
</template>


<script lang="ts">
import axios from "axios";
import Create from "~/pages/items/create.vue";
import ItemForm from "~/components/Items/ItemForm.vue";
import UpdateWarehouseInformation from "~/components/warehouses/updateWarehouseInformation.vue";
import {type Query, type Repository, useRepo} from "pinia-orm";
import Product from "~/models/Product";
import Warehouse from "~/models/Warehouse";
import type {UpdatedData} from "~/types/UpdatedData";
import {updateExpression} from "@babel/types";
import ProductWarehouse from "~/models/ProductWarehouse";

export default {
  components: {UpdateWarehouseInformation, ItemForm, Create},
  data() {
    return {
      WarehouseItem: [] as any[],
      id: null as number | null,
      toggle: false,
      product: {} as Product
    }
  },
  props: {
    warehouseId: Number,
  },
  mounted(): void {
    this.getWarehouseProducts();
  },
  methods: {
    async getWarehouseProducts(): Promise<void> {
      axios.get(`http://localhost:8000/api/warehouses/${this.warehouseId}`).then(res => {
        this.warehouseRepo.save(res.data.data)
      })
    },
    saveWarehouse(product: Product): void {
      this.toggle = !this.toggle
      this.product = product
      console.log(product);
    },
    handleUpdateStock(updateData :UpdatedData): void {
      useRepo(ProductWarehouse).save({product_id: updateData.productId, warehouse_id: updateData.warehouseId , stock: updateData.stock})
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
      return this.productRepo.query()
          .whereHas('warehouses', (query: Query<Warehouse>) => {
            query.whereId(this.warehouseId)
          })
          .with('warehouses', (query: Query<Warehouse>) => {
            query.whereId(this.warehouseId)
          })
          .get();
    },
  }
}
</script>
