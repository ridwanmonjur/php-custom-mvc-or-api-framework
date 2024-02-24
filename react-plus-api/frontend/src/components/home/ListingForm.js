import { useEffect } from "react";
import { useForm } from "react-hook-form";
import { Error } from "../common/error";

export function ListingForm({ products, deleteProducts, error }) {
  const { register, handleSubmit, reset } = useForm();
  const onSubmit = async (data, event) => {
    console.log({ data });
    event.preventDefault();
    deleteProducts(data.sku);
    reset();
  };
  useEffect(() => {
    reset({
      sku: []
    });
  }, []);
  return (
    <div>
      <form
        id="delete_form"
        className="py-5 mx-5"
        onSubmit={handleSubmit(onSubmit)}
      >
        <div className="row py-5 px-5">
          <Error error={error} />
          {typeof products[0] !== "undefined" &&
            products[0] !== null &&
            products.map((value) => (
              <div
                key={value.sku}
                className="col-12-sm col-4 is-one-quarter-widescreen"
              >
                <div className="card px-5 mb-5">
                  <div className="card-content">
                    <label className="checkbox">
                      <input
                        type="checkbox"
                        defaultValue={value?.sku}
                        className="is-warning delete-checkbox mr-2 d-inline"
                        {...register("sku[]")}
                      />
                      <span>{value?.sku}</span>
                    </label>
                    <div className="">
                      <p className="">{value?.name}</p>
                      <p className="">{value?.price} $</p>
                      <p className="">{value?.attribute}</p>
                    </div>
                  </div>
                </div>
              </div>
            ))}
        </div>
        <button
          type="submit"
          id="delete-product-btn-2"
          className="button are-large is-info is-hidden-desktop is-block-touch my-5 mx-5 has-text-centered"
        >
          MASS DELETE
        </button>
      </form>
    </div>
  );
}
