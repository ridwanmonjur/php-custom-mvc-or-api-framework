import fetchWrapper from "./fetch";

const requestOptions = {
    method: 'GET',
};

const fetchAllProducs = async (signal) => {
    requestOptions.signal = signal;
    const data = await fetchWrapper('/', requestOptions);
    if (data !== undefined && 'data' in data) {
        return data.data
    }
    else throw new Error("Cannot fetch the data!")
}

export default fetchAllProducs;