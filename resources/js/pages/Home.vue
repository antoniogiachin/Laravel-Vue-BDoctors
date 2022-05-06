<template>

  <HomeHeader></HomeHeader>
  
</template>

<script>

  import HomeHeader from '../components/HomeHeader';

  export default {

    name: 'Home',

    components: {
    
      HomeHeader,

    }
  }

</script>

<style lang="scss" scoped>

  @import "../../sass/home/home.scss";

</style>