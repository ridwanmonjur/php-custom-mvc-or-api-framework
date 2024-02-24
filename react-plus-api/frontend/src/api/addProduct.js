import fetchWrapper from "./fetch";

const requestOptions = {
    method: 'POST',
};

const addProduct = async (body) => {
    try {
        requestOptions.body = JSON.stringify(body);
        await fetchWrapper('/', requestOptions);
    }
    catch (error) {
        console.log({error})
        throw Error(error);
    }
}

export default addProduct;