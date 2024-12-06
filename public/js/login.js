import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.1/firebase-app.js";
import { getAuth, signInWithEmailAndPassword, createUserWithEmailAndPassword, GoogleAuthProvider, signInWithPopup, sendPasswordResetEmail } from "https://www.gstatic.com/firebasejs/9.6.1/firebase-auth.js";

const firebaseConfig = {
    apiKey: "AIzaSyB4vKYGrsGhccLIdkXy8ZyNJQxqk6S2xhs",
    authDomain: "ilib-library.firebaseapp.com",
    projectId: "ilib-library",
    storageBucket: "ilib-library.firebasestorage.app",
    messagingSenderId: "249196423532",
    appId: "1:249196423532:web:c41d63892758b0561bab49"
};

const app = initializeApp(firebaseConfig);
const auth = getAuth(app);

function setCookie(name, value, hours = 1) {
    const d = new Date();
    d.setTime(d.getTime() + (hours * 60 * 60 * 1000));
    const expires = "expires=" + d.toUTCString();

    document.cookie = `${name}=${value};${expires};path=/;SameSite=Lax`;
}

const loginBt = document.getElementById("login-bt");
if (loginBt) {
    loginBt.addEventListener("click", async (event) => {
        event.preventDefault();

        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;

        try {
            const userCredential = await signInWithEmailAndPassword(auth, email, password);
            const user = userCredential.user;

            const idToken = await user.getIdToken(true);

            const response = await fetch("https://library-api-0e3t.onrender.com/users/login", {
                method: "POST",
                headers: {
                    "Authorization": `Bearer ${idToken}`,
                    "Content-Type": "application/json",
                }
            });

            await response.json();
            setCookie("user_token", idToken);

            document.getElementById("email").value = "";
            document.getElementById("password").value = "";

            showMessageModal("Exito", "Se inicio sesion correctamente.", 'public/img/success.png');
            window.location.reload();
        } catch (error) {
            showMessageModal("Error", "Correo o contraseña incorrectos.", 'public/img/warning.png');
        }
    });
}

const registerBt = document.getElementById("register-bt");
if (registerBt) {
    registerBt.addEventListener("click", async (event) => {
        event.preventDefault();

        const name = document.getElementById("name").value;
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirm-password").value;

        if (password !== confirmPassword) {
            alert("Las contraseñas no coinciden.");
            return;
        }

        try {
            const userCredential = await createUserWithEmailAndPassword(auth, email, password);

            const user = userCredential.user;

            const idToken = await user.getIdToken(true);

            const response = await fetch("https://library-api-0e3t.onrender.com/users/register", {
                method: "POST",
                headers: {
                    "Authorization": `Bearer ${idToken}`,
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    name: name,
                    email: email,
                    role : "user",
                }),
            });

            await response.json();

            document.getElementById("name").value = "";
            document.getElementById("email").value = "";
            document.getElementById("password").value = "";
            document.getElementById("confirm-password").value = "";

            showMessageModal("Exito", "Se registro correctamente.", 'public/img/success.png');
        } catch (error) {
            showMessageModal("Error", "Algo salio mal.", 'public/img/warning.png');
        }
    });
}

const googleBt = document.getElementById("google-bt");
if (googleBt) {
    googleBt.addEventListener("click", async (event) => {
        event.preventDefault();

        const provider = new GoogleAuthProvider();

        try {
            const result = await signInWithPopup(auth, provider);

            const user = result.user;

            const idToken = await user.getIdToken(true);

            const response = await fetch("https://library-api-0e3t.onrender.com/users/register", {
                method: "POST",
                headers: {
                    "Authorization": `Bearer ${idToken}`,
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    name: user.displayName,
                    email: user.email,
                    role : "user",
                }),
            });

            await response.json();
            setCookie("user_token", idToken);
            showMessageModal("Exito", "Se inicio sesion correctamente.", 'public/img/success.png');
            window.location.reload();
        } catch (error) {
            showMessageModal("Error", "Algo salio mal.", 'public/img/warning.png');
        }
    });
}

const forgotPassword = document.getElementById("forgot-bt");
if (forgotPassword) {
    forgotPassword.addEventListener("click",
        async (event) => {
            event.preventDefault();
            const email = document.getElementById("email").value;

            if (!email) {
                showMessageModal("Error", "Ingrese un correo.", 'public/img/warning.png');
                return;
            }

            await sendPasswordResetEmail(auth, email)
                .then(() => {
                    showMessageModal("Exito", "Se envio un correo para restablecer tu contraseña.", 'public/img/success.png');

                    document.getElementById("email").value = "";
                })
                .catch((error) => {
                    showMessageModal("Error", "Correo no registrado.", 'public/img/warning.png');
                });
        });
}


