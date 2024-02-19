<template>
  <div>
    <NuxtPage products/>
  </div>
</template>

<script>
export default {
  mounted() {
    this.$router.push('/products');
  }
}
</script>