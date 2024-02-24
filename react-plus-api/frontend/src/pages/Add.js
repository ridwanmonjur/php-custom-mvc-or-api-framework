import { useNavigate } from "react-router-dom";
import { Navbar } from "../components/common/Navbar";
import { AddProduct } from "../components/add/AddProduct";
import addProduct from "../api/addProduct";
import { useState } from "react";
import { getErrorMessage } from "../utils/getErrorMessage";
import { toastError } from "../utils/toast";
function Add() {
  const navigate = useNavigate();
  const [error, setError] = useState(null);
  const addProductMethod = async (product) => {
    try {
      await addProduct(product);
      navigate("/");
    } catch (error) {
      setError(getErrorMessage(error));
      toastError("Your submission has failed!");
    }
  };
  return (
    <>
      <Navbar title="Add Product" titleHyperlink="/add">
        <button
          type="submit"
          id="product-form-btn"
          form="product_form"
          // name="submit"
          className="button are-large is-info mx-5 is-hidden-touch"
        >
          Save
        </button>
        <button
          onClick={() => navigate("/")}
          className="button are-large is-info "
        >
          Cancel
        </button>
      </Navbar>
      <main>
        <AddProduct addProductMethod={addProductMethod} error={error} />
      </main>
    </>
  );
}

export default Add;
