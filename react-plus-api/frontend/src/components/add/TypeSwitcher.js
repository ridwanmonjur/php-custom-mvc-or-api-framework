import { Input } from "../common/forms/Input";
import { Label } from "../common/forms/Label";

export function TypeSwitcher({ register, switcher }) {
  return (
    <>
      {switcher === "Disc" ? (
        <>
          <DVDForm register={register} />
        </>
      ) : switcher === "Book" ? (
        <>
          <BookForm register={register} />{" "}
        </>
      ) : switcher === "Furniture" ? (
        <>
          <FurnitureForm register={register} />{" "}
        </>
      ) : (
        <div className="mt-4"> No type chosen </div>
      )}
    </>
  );
}

const FurnitureForm = ({ register }) => {
  return (
    <>
      <div>
        <Label classNames="mt-4" htmlFor="weight">
          Height (CM)
        </Label>
        <div>
          <Input
            id="height"
            {...register("attribute[height]")}
            name="attribute[height]"
            placeHolder="Please provide height."
          />
        </div>
        <Label classNames="mt-4" htmlFor="weight">
          Width (CM)
        </Label>
        <div>
          <Input
            id="width"
            {...register("attribute[width]")}
            name="attribute[width]"
            placeHolder="Please provide width."
          />
        </div>
        <Label classNames="mt-4" htmlFor="length">
          Length (CM)
        </Label>
        <div>
          <Input
            id="length"
            {...register("attribute[length]")}
            name="attribute[length]"
            placeHolder="Please provide length."
          />
        </div>
      </div>

      <h3 className="ml-5 is-size-5 mt-5 has-text-weight-semibold">
        Please, provide dimensions in CM.
      </h3>
    </>
  );
};

const BookForm = ({ register }) => {
  return (
    <>
      <div>
        <Label classNames="mt-4" htmlFor="weight">
          Weight (KG)
        </Label>
        <div>
          <Input
            id="weight"
            {...register("attribute[weight]")}
            name="attribute[weight]"
            placeHolder="Please provide weight."
          />
        </div>
      </div>

      <h3 className="ml-5 is-size-5 mt-5 has-text-weight-semibold">
        Please, provide weight in KG.
      </h3>
    </>
  );
};

const DVDForm = ({ register }) => {
  return (
    <>
      <div>
        <Label classNames="mt-4" htmlFor="size">
          SIZE (MB)
        </Label>
        <div>
          <Input
            id="size"
            {...register("attribute[size]")}
            name="attribute[size]"
            placeHolder="Please provide size."
          />
        </div>
      </div>

      <h3 className="ml-5 is-size-5 mt-5 has-text-weight-semibold">
        Please, provide size in CM.
      </h3>
    </>
  );
};
