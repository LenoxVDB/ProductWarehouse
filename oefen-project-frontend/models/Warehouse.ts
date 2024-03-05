import BaseModel from "~/models/BaseModel";
import ProductWarehouse from "~/models/ProductWarehouse";
import Product from "~/models/Product";
export default class Warehouse extends BaseModel {
    static entity = 'warehouses'

    static fields () {
        return {
            ...BaseModel.fields(),
            name: this.string(null),
            products: this.belongsToMany(Product, ProductWarehouse, 'warehouse_id', 'product_id'),
        }
    }

    declare name: string
    declare products: Product[] | undefined
    declare pivot: ProductWarehouse  | undefined
}