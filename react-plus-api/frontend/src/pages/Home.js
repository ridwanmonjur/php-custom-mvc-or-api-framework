import React, { useEffect, useState } from "react";
import { Navbar } from "../components/common/Navbar";
import { ListingForm } from "../components/home/ListingForm";
import { useNavigate } from "react-router-dom";
import fetchAllProducs from "../api/allProducts";
import { getErrorMessage } from "../utils/getErrorMessage";
import deleteProducs from "../api/deleteProduct";

function Home() {
  const [products, setProducts] = useState([]);
  const [error, setError] = useState(null);
  const resetProducts = async (signal) => {
    try {
      await fetchAllProducs(signal).then((data) => setProducts(data));
    } catch (error) {
      if (
        error.error &&
        error !== "DOMException: The user aborted a request."
      ) {
        setError(getErrorMessage(error));
      }
    }
  };
  useEffect(() => {
    const abortController = new AbortController();
    const signal = abortController.signal;
    resetProducts(signal);
    return () => abortController.abort();
  }, []);
  const deleteProducts = async (skuList) => {
    if (skuList === undefined || skuList === null) return;
    try {
      await deleteProducs({ sku: skuList }).then(() =>
        setProducts((oldList) => {
          return oldList.filter(
            (value) => !skuList.includes(String(value.sku))
          );
        })
      );
    } catch (error) {
      setError(getErrorMessage(error));
    }
  };
  const navigate = useNavigate();
  return (
    <>
      <Navbar title="Listing" titleHyperlink="/">
        <button
          onClick={() => navigate("/add")}
          type="button"
          className="button are-large is-info mx-5"
        >
          ADD
        </button>
        <button
          type="submit"
          id="delete-product-btn"
          form="delete_form"
          className="button are-large is-info is-hidden-touch"
        >
          MASS DELETE
        </button>
      </Navbar>
      <main>
        <ListingForm
          products={products}
          deleteProducts={deleteProducts}
          error={error}
        />
      </main>
    </>
  );
}

export default Home;
