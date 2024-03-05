import BaseModel from "~/models/BaseModel";
import Warehouse from "~/models/Warehouse";
import ProductWarehouse from "~/models/ProductWarehouse";

export default class Product extends BaseModel {
    static entity = 'products'

    static fields() {
        return {
            ...BaseModel.fields(),
            name: this.string(null),
            price: this.number(null),
            summary: this.string(null),
            warehouses: this.belongsToMany(Warehouse, ProductWarehouse, 'product_id', 'warehouse_id'),
        }
    }

    declare name: string
    declare price: number
    declare summary: string
    declare warehouses: Warehouse[] | undefined
    declare pivot: ProductWarehouse  | undefined
}