<template>
  <div class="sidebar">
    <h1>SHARE</h1>
    <div class="menu-item" @click="redirectToPosts">ホーム</div>
    <div class="menu-item" @click="logout">ログアウト</div>
    <div class="post-box">
      <textarea v-model="postContent" placeholder="シェア"></textarea>
      <button @click="sharePost">シェアする</button>
    </div>
  </div>
</template>

<script>
import firebase from '~/plugins/firebase'
import axios from 'axios'

export default {
  name: 'SideNav',
  data() {
    return {
      postContent: '' // テキストエリアの内容を格納するデータプロパティ
    };
  },
  methods: {
    logout() {
      firebase.auth().signOut()
        .then(() => {
          this.$router.push('/login');
        })
        .catch((error) => {
          console.error('ログアウトに失敗しました:', error);
        });
    },
    redirectToPosts() {
      this.$router.push('/posts_id');
    },
    async sharePost() {
      const user = firebase.auth().currentUser;
      if (!user) {
          alert('ログインしてください。');
          return;
      }

      try {
          await axios.post('http://localhost/api/posts', {
              content: this.postContent,
              firebase_uid: user.uid  // firebaseのUIDを送信
          });
          alert('投稿が完了しました');
          this.postContent = ''; // テキストエリアをクリア
      } catch (error) {
          console.error('投稿に失敗しました:', error);
          alert('投稿に失敗しました。再度お試しください。');
      }
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
