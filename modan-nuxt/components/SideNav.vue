<template>
  <div class="side-nav">
    <div class="title">
      SHARE
    </div>
    <div>
      <router-link to="/">ホーム</router-link>
    </div>
    <button @click="logout">ログアウト</button>
    <textarea v-model="postContent" placeholder="投稿内容"></textarea>
    <button @click="submitPost">シェアする</button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      postContent: ''
    };
  },
  methods: {
    logout() {
      // ログアウト処理
    },
    submitPost() {
      // 投稿内容をサーバーに送信する処理
    }
  }
}
</script>

<style scoped>
.side-nav {
  width: 30%; /* 例として、全体の30%を使用 */
  background-color: #1A1A2E;
  padding: 20px;
  box-shadow: 2px 0px 5px rgba(0, 0, 0, 0.2);
  height: 100vh;
}

.title {
  font-size: 24px;
  font-weight: bold;
  color: #E94560;
  margin-bottom: 20px;
}

router-link {
  display: block;
  color: #FFF;
  text-decoration: none;
  margin-bottom: 10px;
  font-size: 18px;
}

button {
  display: block;
  background-color: #E94560;
  color: #FFF;
  border: none;
  padding: 10px 20px;
  margin-top: 20px;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s;
}

button:hover {
  background-color: #D43F50;
}

textarea {
  width: 100%;
  height: 120px;
  padding: 10px;
  margin-top: 20px;
  border: none;
  border-radius: 5px;
  resize: none;
}
</style>
