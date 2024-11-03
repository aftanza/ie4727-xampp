import re

# Read the original dummy data
with open("dummy_data.txt", "r") as file:
    insert_sql = file.read()


# Function to replace img_url with the new format
def replace_img_url(match):
    # Extract the id from the matched pattern
    product_id = match.group(1)
    # Return the new img_url format
    return f"'https://picsum.photos/id/{product_id}/280'"


# Use regular expression to find and replace img_url
# Pattern explanation:
# - \( (\d+) , ... , 'https:\/\/.*?\.jpg' : Captures the product id and original img_url
insert_sql = re.sub(r"'https:\/\/.*?\/product(\d+)\.jpg'", replace_img_url, insert_sql)

# Write the modified data back to dummy_data.txt
with open("dummy_data.txt", "w") as file:
    file.write(insert_sql)

print("Image URLs have been successfully updated!")
