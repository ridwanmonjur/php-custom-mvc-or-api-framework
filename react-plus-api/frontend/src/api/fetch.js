const fetchWrapper = (url, requestOptions) => {
    return fetch(`${process.env.REACT_APP_BACKEND}${url}`, requestOptions)
        .then(async response => {
            if (response.status===204) return;
            const data = await response.json();
            if (!response.ok) {
                const error = (data && data.error) || response.status;
                return Promise.reject(error);
            }
            return data;
        })
}
export default fetchWrapper;