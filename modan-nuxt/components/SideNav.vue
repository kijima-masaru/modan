<template>
  <div class="sidebar">
    <h1>SHARE</h1>
    <div class="menu-item">ホーム</div>
    <div class="menu-item">ログアウト</div>
    <div class="post-box">
      <textarea placeholder="シェア"></textarea>
      <button>シェアする</button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'SideNav'
}
</script>

<style scoped>
.sidebar {
  width: 20%;
  background-color: #2c3e50;
  color: white;
  padding: 20px;
}

.menu-item {
  margin: 20px 0;
  cursor: pointer;
}

.post-box {
  margin-top: 50px;
}
</style>
