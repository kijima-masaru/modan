import firebase from 'firebase/app';
import 'firebase/auth';

if (!firebase.apps.length) {
    firebase.initializeApp({
        apiKey: "AIzaSyBA7EMEkNBOzonEIqWhzrUCoH5y4ar_tLw",
        authDomain: "modan-2aa4d.firebaseapp.com",
        projectId: "modan-2aa4d",
        storageBucket: "modan-2aa4d.appspot.com",
        messagingSenderId: "736494956024",
        appId: "1:736494956024:web:b6573a4210af39e34bfa0d",
        measurementId: "G-6Y5RQNE04H"
    });
}

export default firebase;