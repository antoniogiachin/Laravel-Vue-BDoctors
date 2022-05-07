<template>
  <div>

    <HomeHeader></HomeHeader>
    <HomeMain></HomeMain>
    <HomeFooter></HomeFooter>

  </div>
</template>

<script>

  import HomeHeader from '../components/HomeHeader';
  import HomeMain from '../components/HomeMain';
  import HomeFooter from '../components/HomeFooter';

  export default {

    name: 'Home',

    components: {
    
      HomeHeader,
      HomeMain,
      HomeFooter,

    }
  }

</script>

<style lang="scss" scoped>

  @import "../../sass/home/home.scss";

</style>