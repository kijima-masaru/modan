<template>
  <div class="sidebar">
    <h1>SHARE</h1>
    <div class="menu-item">ホーム</div>
    <div class="menu-item" @click="logout">ログアウト</div>
    <div class="post-box">
      <textarea placeholder="シェア"></textarea>
      <button>シェアする</button>
    </div>
  </div>
</template>

<script>
import firebase from '~/plugins/firebase'
export default {
  name: 'SideNav',
  methods: {
    logout() {
      firebase.auth().signOut()
        .then(() => {
          this.$router.push('/');
        })
        .catch((error) => {
          console.error('ログアウトに失敗しました:', error);
        });
    }
  }
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
