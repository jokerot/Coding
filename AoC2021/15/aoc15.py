from collections import deque
with open("D:\Coding\AoC2021\\15\input.txt") as f:
    ls = f.read().strip().split("\n") 
 
# A queue node used in BFS
class Node:
    # (x, y) represents coordinates of a cell in the matrix
    # maintain a parent node for the printing path
    def __init__(self, x, y, parent=None):
        self.x = x
        self.y = y
        self.parent = parent
 
    def __repr__(self):
        return str((self.x, self.y))
 
    def __eq__(self, other):
        return self.x == other.x and self.y == other.y
 
 
# Below lists detail all four possible movements from a cell
row = [-1, 0, 0, 1]
col = [0, -1, 1, 0]
 
 
# The function returns false if (x, y) is not a valid position
def isValid(x, y, N):
    return (0 <= x < N) and (0 <= y < N)
 
 
# Utility function to find path from source to destination
def getPath(node, path=[]):
    if node:
        getPath(node.parent, path)
        path.append(node)
 
 
# Find the shortest route in a matrix from source cell (x, y) to
# destination cell (N-1, N-1)
def findPath(matrix, x=0, y=0):
    # base case
    if not matrix or not len(matrix):
        return
 
    # `N × N` matrix
    N = len(matrix)
 
    # create a queue and enqueue the first node
    q = deque()
    src = Node(x, y)
    q.append(src)
 
    # set to check if the matrix cell is visited before or not
    visited = set()
 
    key = (src.x, src.y)
    visited.add(key)
 
    # loop till queue is empty
    while q:
 
        # dequeue front node and process it
        curr = q.popleft()
        i = curr.x
        j = curr.y
 
        # return if the destination is found
        if i == N - 1 and j == N - 1:
            path = []
            getPath(curr, path)
            return path
 
        # value of the current cell
        n = 1
 
        # check all four possible movements from the current cell
        # and recur for each valid movement
        for k in range(len(row)):
            # get next position coordinates using the value of the current cell
            x = i + row[k] * n
            y = j + col[k] * n
 
            # check if it is possible to go to the next position
            # from the current position
            if isValid(x, y, N):
                # construct the next cell node
                next = Node(x, y, curr)
                key = (next.x, next.y)
 
                # if it isn't visited yet
                if key not in visited:
                    # enqueue it and mark it as visited
                    q.append(next)
                    visited.add(key)
 
    # return None if the path is not possible
    return
 
 
if __name__ == '__main__':
 
    matrix = [x.split for x in ls]
 
    # Find a route in the matrix from source cell (0, 0) to
    # destination cell (N-1, N-1)
    path = findPath(matrix)
 
    if path:
        print('The shortest path is', path)
        print('The shortest path is', len(path))
    else:
        print('Destination is not found')