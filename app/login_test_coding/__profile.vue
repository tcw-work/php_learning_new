<template>
  <!--templateタグの中が、読み込まれてrouter-viewに展開される内容 -->
  <div>
    <b>{{ text }}</b>
  </div>
</template>
<script>
module.exports = {
  data: function () {
    return {
      text: "profile.vueの内容を表示", //コンポーネントのデータとして、textというプロパティを作成
    };
  },
};
</script>