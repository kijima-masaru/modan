<template>
  <div class="container">
    <div class="title-container">
      <img src="path_to_your_image" alt="Share" class="title-image"/> <!-- ① -->
    </div>
    <div class="nav-links">
      <a href="/register">新規登録</a> <!-- ② -->
      <a href="/login">ログイン</a> <!-- ③ -->
    </div>
    <div class="registration-container">
      <h2>新規登録タイトル</h2> <!-- ④ -->
      <input type="text" placeholder="ユーザーネーム" v-model="username"/> <!-- ⑤ -->
      <input type="email" placeholder="メールアドレス" v-model="email"/> <!-- ⑥ -->
      <input type="password" placeholder="パスワード" v-model="password"/> <!-- ⑦ -->
      <button @click="register">新規登録</button> <!-- ⑧ -->
    </div>
  </div>
</template>

<script>
import firebase from "~/plugins/firebase";
import axios from 'axios';
export default {
  data() {
    return {
      email: null,
      password: null,
      username: null,
    };
  },
  methods: {
    register() {
      if (!this.email || !this.password) {
        alert("メールアドレスまたはパスワードが入力されていません。");
        return;
      }
      firebase
        .auth()
        .createUserWithEmailAndPassword(this.email, this.password)
        .then((data) => {
          data.user.sendEmailVerification().then(() => {
            // Laravel APIを呼び出してDBに保存
            axios.post('/api/register', {
                username: this.username,
                email: this.email,
                password: this.password
            }).then(response => {
                if (response.status === 201) {
                    alert('DBへの保存に成功しました！');
                    this.$router.replace("/confirm");
                }
            }).catch(error => {
                alert('DBへの保存中にエラーが発生しました');
            });
          });
        })
        .catch((error) => {
          switch (error.code) {
            case "auth/invalid-email":
              alert("メールアドレスの形式が違います。");
              break;
            case "auth/email-already-in-use":
              alert("このメールアドレスはすでに使われています。");
              break;
            case "auth/weak-password":
              alert("パスワードは6文字以上で入力してください。");
              break;
            default:
              alert("エラーが起きました。しばらくしてから再度お試しください。");
              break;
          }
        });
    },
}
};
</script>

<style scoped>
.container {
  display: flex;
  flex-direction: column;
  align-items: center;
  font-family: Arial, sans-serif; /* シンプルなフォントスタイル */
}
.title-container {
  margin-top: 50px;
}
.title-image {
  width: 150px;
  height: auto;
}
.nav-links {
  margin-top: 20px;
  display: flex;
  justify-content: center; /* 中央揃え */
  gap: 20px;
}
.nav-links a {
  color: #333; /* ダークグレーの色 */
  text-decoration: none;
  letter-spacing: 2px; /* 文字の間隔を調整 */
}
.nav-links a:hover {
  text-decoration: underline;
}
.registration-container {
  margin-top: 50px;
  width: 340px;
  display: flex;
  flex-direction: column;
  gap: 20px; /* 項目間のスペースを増やす */
}
input[type="text"], input[type="email"], input[type="password"] {
  padding: 12px; /* パディングを増やす */
  border: 2px solid #ccc; /* 枠線を少し太くする */
  border-radius: 4px;
  font-size: 18px; /* フォントサイズを増やす */
}
button {
  padding: 12px 25px; /* パディングを増やす */
  background-color: purple;
  color: white;
  border: none;
  border-radius: 4px;
  font-size: 18px; /* フォントサイズを増やす */
  cursor: pointer;
}
button:hover {
  background-color: #8a2be2;
}

</style>