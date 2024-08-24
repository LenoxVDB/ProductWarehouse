<script lang="ts">
export default {
  computed: {
    warehouseId(): number|undefined {
      return parseInt(this.$route.params.warehouse)
    }
  }
}
</script>

<template>
  <div class="flex flex-wrap overflow-hidden">
    <div class="w-full md:w-1/2 p-2 box-border">
      <warehouses-warehouse-over-view :warehouseId="warehouseId" class="w-full"/>
    </div>
    <div class="w-full md:w-1/2 p-2 box-border">
      <warehouses-asign-to-warehouse v-if="warehouseId" :warehouseId="warehouseId" class="w-full"/>
    </div>
  </div>
</template>