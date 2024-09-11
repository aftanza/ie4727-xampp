import random
from datetime import datetime, timedelta


# Helper function to generate random datetime
def random_date(start, end):
    return start + timedelta(
        seconds=random.randint(0, int((end - start).total_seconds())),
    )


# Define categories and brands
categories_updated = ["keyboards", "mice", "gpu", "cpu", "ram", "prebuilt"]
brands_updated = ["apple", "samsung", "sony", "dell", "asus"]

# Start creating SQL insert command
insert_sql = "INSERT INTO `listings` (`id`, `name`, `descripton`, `price`, `category`, `img_url`, `brand`, `rating`, `created_at`, `updated_at`) VALUES\n"

# Generate 200 dummy data rows
values = []
for i in range(1, 201):
    product_values = (
        i,
        f"Product {i}",
        f"Description for product {i}",
        round(random.uniform(10, 2000), 2),  # price between 10 and 2000
        random.choice(categories_updated),
        f"https://example.com/product{i}.jpg",
        random.choice(brands_updated),
        round(random.uniform(1, 5), 1),  # rating between 1 and 5
        random_date(datetime(2021, 1, 1), datetime(2023, 12, 31)).strftime(
            "%Y-%m-%d %H:%M:%S"
        ),
        random_date(datetime(2021, 1, 1), datetime(2023, 12, 31)).strftime(
            "%Y-%m-%d %H:%M:%S"
        ),
    )
    values.append(f"({', '.join(repr(x) for x in product_values)})")

# Combine all values into a single SQL command
insert_sql += ",\n".join(values) + ";"

# Write to a text file
with open("dummy_data.txt", "w") as file:
    file.write(insert_sql)
