<template>
  <div>
    <router-link to="/profile">profileの内容に切り替え完了</router-link><br />
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: "App",
};
</script>