
const cart = {
    items: [{ product: [WholeProduct], amount: amount }],
    price,
};

const address = {
    name, slug, streetName, buildingNumber, city, postalCode
}

const buyer = {
    username,
    email,
    name,
    addresses: [address],
    cart: cart
};

const category = [
    id, name, slug, fields
];

const product = [{
    name: string,
    description: string,
    price: number,
    slug: string,
    category: categoryId,
    remaining: number,
    images: [images],
    attributes: {
        // Different for every category
    }
}]

const owner = {
    id: string,
    name: string,
    email: string
}

const order = {
    items: [{ product: [WholeProduct], amount: amount }],
    price,
}

const store = {
    name: string,
    description: string,
    slug: string,
    owner: owner,
    premissions: {},
    categories: [category],
    products: [product],
    buyers: [buyer],
    orders: [order]
}

const data = {
    stores: [store]
};