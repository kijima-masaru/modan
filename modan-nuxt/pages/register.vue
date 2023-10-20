<template>
  <div class="register">
  <AuthHeader />
    <label
      >ユーザーネーム： <input v-model="username" type="text" required
    /></label>
    <br />
    <label
      >メールアドレス： <input v-model="email" type="email" required
    /></label>
    <br />
    <label
      >パスワード： <input v-model="password" type="password" required
    /></label>
    <br />
    <button @click="register">新規登録</button>
  </div>
</template>

<script>
import firebase from "~/plugins/firebase";
import axios from 'axios';
export default {
  data() {
    return {
      username: null,
      email: null,
      password: null,
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
            this.$router.replace("/confirm");

            // ここでLaravel APIを呼び出す
            this.saveToLaravelDB(data.user.uid);
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
    saveToLaravelDB(uid) {   // このメソッドの前に、カンマが不足していました。
      // ここでaxiosや別のHTTPクライアントを使用して、LaravelのAPIを呼び出し、
      // ユーザー情報をusersテーブルに保存します。
      // APIのエンドポイントとリクエストの形式に応じて、以下のコードを調整してください。

      const payload = {
        uid: uid, // このuidはfirebase_uidとしてLaravel側で保存します
        name: this.username,
        email: this.email,
        password: this.password // 実際にはパスワードは送信しないようにすることをおすすめします。
      };

      axios.post('http://localhost/api/register', payload)
        .then(response => {
          console.log('User saved to Laravel DB:', response.data);
        })
        .catch(error => {
          console.error('Error saving user to Laravel DB:', error);
        });
      },
    },
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