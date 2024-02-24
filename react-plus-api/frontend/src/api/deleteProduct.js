import fetchWrapper from "./fetch";

const requestOptions = {
    method: 'POST',
};

const deleteProducs = async (body) => {
    try {
        requestOptions.body = JSON.stringify(body);
        await fetchWrapper('/delete', requestOptions);
    }
    catch (error) {
        throw Error(error);
    }
}

export default deleteProducs;