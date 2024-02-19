<template>
  <div>
    <NuxtPage/>
  </div>
</template>

<script>
export default {
  mounted() {
    this.$router.push('/products');
  }
}
</script>