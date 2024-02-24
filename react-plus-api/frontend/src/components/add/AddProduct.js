/* eslint-disable eqeqeq */
import { useForm } from "react-hook-form";
import { Input } from "../common/forms/Input";
import { Label } from "../common/forms/Label";
import { useState } from "react";
import { Error } from "../common/error";
import { TypeSwitcher } from "./TypeSwitcher";

export function AddProduct({ error, addProductMethod }) {
  const [switcher, setSwitcher] = useState("");
  const {
    register,
    handleSubmit,
    formState: { errors }
  } = useForm({
    mode: "all"
  });
  const onSubmit = (data, event) => {
    console.log({ data });
    addProductMethod(data);
    event.preventDefault();
    // reset();
  };
  return (
    <>
      <form
        id="product_form"
        onSubmit={handleSubmit(onSubmit)}
        className="px-5 py-5 my-5 mx-auto col-12-sm col-6"
      >
        <div>
          <Error error={error} />
          <Label htmlFor="sku">SKU</Label>
          <div>
            <Input
              classNames="col-5"
              type="text"
              id="sku"
              {...register("sku", {
                required: "Sku field must be provided..."
              })}
              placeholder="Please provide sku."
            />
            {errors.sku && (
              <span className="has-text-danger mt-3">
                {errors.sku?.message}
              </span>
            )}
          </div>
        </div>
        <div className="row">
          <Label classNames="mt-4" htmlFor="name">
            Name
          </Label>
          <div>
            <Input
              id="name"
              type="text"
              {...register("name", {
                required: "Name field must be provided"
              })}
              placeholder="Please provide name."
            />
            {errors.name && (
              <span className="has-text-danger mt-3">
                {errors.name?.message}
              </span>
            )}
          </div>
        </div>
        <div className="row">
          <Label classNames="mt-4" htmlFor="price">
            Price ($)
          </Label>
          <div>
            <Input
              id="price"
              {...register("price", {
                required: "Price field must be provided"
              })}
              placeholder="Insert any non-negative number for the price."
            />
            {errors.price && (
              <span className="has-text-danger mt-3">
                {errors.price?.message}
              </span>
            )}
          </div>
        </div>
        <div className="row">
          <Label classNames="mt-4" htmlFor="switcher">
            Type Switcher
          </Label>
          <div>
            <select
              id="productType"
              className="input is-fullwidth is-warning"
              {...register("switcher", {
                required: "Type field must be provided",
                onChange: (event) => {
                  setSwitcher(event.target.value);
                }
              })}
            >
              {errors.switcher && (
                <span className="has-text-danger mt-3">
                  {errors.switcher?.message}
                </span>
              )}
              <option value="" id="none">
                Type Switcher
              </option>
              <option value="Disc" id="Disc_form">
                DVD
              </option>
              <option value="Furniture" id="Furniture_form">
                Furniture
              </option>
              <option value="Book" id="Book_form">
                Book
              </option>
            </select>
            {errors.switcher && (
              <span className="has-text-danger mt-3">
                {errors.switcher?.message}
              </span>
            )}
          </div>
        </div>
        <TypeSwitcher switcher={switcher} register={register} />
        <button
          type="submit"
          form="product_form"
          name="submit"
          className="button are-large is-info is-hidden-desktop is-block-touch my-5 mx-5 has-text-centered"
        >
          Save
        </button>
      </form>
    </>
  );
}
