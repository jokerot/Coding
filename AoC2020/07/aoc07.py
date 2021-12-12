with open("D:\Learning\Coding\AoC2020\\07\input.txt") as f:
    ls = f.read().strip().split("\n")

import re

def create_data_structure(initial_data):
    result = {}
    
    for item in initial_data:
        bag_and_contents_regex = r"^(\w+ \w+) bags contain (.*)"
        bag_and_contents = re.search(bag_and_contents_regex, item)
        bag_type = bag_and_contents[1]
        
        contents_string = bag_and_contents[2][:-1] # [:-1] removes trailing period
        contents_regex = r"([0-9] )*(\w+ \w+) bag"
        contents_tuples = re.findall(contents_regex, contents_string)
        
        bag_contents = []
        for contents_tuple in contents_tuples:
            if contents_tuple[1] != "no other":
                bag_contents.append({
                    "count": int(contents_tuple[0]),
                    "type": contents_tuple[1]
                })
                
        result[bag_type] = bag_contents
        
    return result

bags = create_data_structure(ls)

def shiny_gold_bag_count(bag_collection, bag_name):
    count = 0
    bag = bag_collection[bag_name]
    
    if len(bag) == 0:
        return count
    else:
        for sub_bag in bag:
            if sub_bag["type"] == "shiny gold":
                count += 1
            count += shiny_gold_bag_count(bag_collection, sub_bag["type"])
        
    return count

def bags_containing_at_least_one_shiny_gold_bag(bag_collection):
    count = 0

    for bag_name in bag_collection.keys():
        if shiny_gold_bag_count(bag_collection, bag_name) > 0:
            print(f"{bag_name} bags contain at least one shiny gold bag!")
            count += 1

    return count

print("solution 1 : ", bags_containing_at_least_one_shiny_gold_bag(bags))

with open("D:\Learning\Coding\AoC2020\\07\input2.txt") as f:
    ls2 = f.read().strip().split("\n")

bags2 = create_data_structure(ls2)
    