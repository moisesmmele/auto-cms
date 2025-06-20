
const security = {
    user: JSON.parse(localStorage.getItem('user')),
    requestOptions: function(payload) {
        const headers = new Headers();
        headers.append("Content-Type", "application/json")
        headers.append("Authorization", "Bearer " + this.user.token)

        return {
            method: "POST",
            headers: headers,
            body: JSON.stringify(payload)
        }
    },
    login(email, password) {
        let url = `${import.meta.env.VITE_API_URL}/auth/login`
        console.log(url)
        return fetch(url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({email, password})
        })
            .then(response => {
                if (!response.ok) {
                    return false
                }
                return response.json();
            })
            .then(data => {
                if (!data.token) return false;

                const user = {
                    id: data.id,
                    firstName: data.first_name,
                    lastName: data.last_name,
                    email: data.email,
                    token: data.token,
                }
                localStorage.setItem('user', JSON.stringify(user))
                return true;
            })
            .catch(error => {
                console.error('Error during login:', error);
                return false;
            });
    },
    logout(id) {
        const payload = { id: id }
        return fetch(`${import.meta.env.VITE_API_URL}/auth/logout`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' }, // fixed typo
            body: JSON.stringify(payload)
        })
            .then(response => {
                if (!response.ok) {
                    return false;
                } else {
                    localStorage.removeItem('user');
                    return true;
                }
            })
            .catch(error => {
                console.error('Error during logout:', error);
                return false;
            });
    },

    loadUser() {
        return JSON.parse(localStorage.getItem('user'))
    }
}
export default security